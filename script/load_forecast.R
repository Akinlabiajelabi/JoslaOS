###### Load Forecast for Electric Utility Supply using supervised learning algorithm #######

## Set working directory to latest development
#setwd("0")

## Load toolbox
library(dplyr)
library(plyr)
library(ggplot2)
library(tidyr)

## Get data
data <- read.csv("load_data.csv")

## Prepare data
str(data)

# Code to sample data based on system-level or node-level analysis
dataSystem <- subset(data, feeder == "IPP-1")
#dataNode <- subset(data, feeder != "IPP-1")

# Code to add time factor columns
dataSystem <- mutate(dataSystem,
                     year=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%Y"), levels=c("2015", "2016")),
                     month=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%b"), levels=c("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")),
                     week=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%W"), levels=c("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53")),
                     day=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%d"), levels=c("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31")),
                     weekday=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%a"), levels=c("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun")),
                     hour=factor(strftime(as.POSIXlt(Timestamp, origin="1970-01-01", tz="UTC"), format="%H"), levels=c("00","01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"))
                     )
# Code to add privacy to mask private data usage
dataSystem$feeder <- mapvalues(dataSystem$feeder, 
                               from = c("IPP-1", "Breaker 1-4", "Breaker 5-8", "Lagos House", "LTV & Co.", "Multi-Agency"), 
                               to = c("utility", "zone1", "zone2", "zone3", "zone4", "zone5")
                               )

# Code to convert current to numeric data type
dataSystem$current <- as.numeric(levels(dataSystem$current))[dataSystem$current]

# Code to compute load (KW) from current column; Given that voltage and power factor are constant across the utility at 11kV and 0.9 respectively
# Also handles missing value by filling with zero
dataSystem <- ddply(dataSystem, .(Timestamp), transform, load = ifelse(is.na(current)==TRUE, 0, (11000 * current * 0.9 * 1.732)/1000))

# Code to column by name
dataSystem <- dataSystem[c("Timestamp", "year", "month", "week", "weekday", "day", "hour", "feeder", "current", "load")]

## Explore data
summary(dataSystem)

# Code to sample data based on time factor
dataSystemYear    <- subset(dataSystem, year == "2015")
dataSystemMonth   <- subset(subset(dataSystem, year == "2015"), month == "Jul")
dataSystemWeek    <- subset(subset(subset(dataSystem, year == "2015"), month == "Jul"), week == "28")
dataSystemWeekday <- subset(subset(subset(dataSystem, year == "2015"), month == "Jul"), weekday == "Tue")
dataSystemDay     <- subset(subset(subset(subset(dataSystem, year == "2015"), month == "Jul"), week == "28"), weekday == "Thu" & day == "16")
dataSystemHour    <- subset(subset(subset(subset(subset(dataSystem, year == "2015"), month == "Jul"), week == "28"), weekday == "Thu" & day == "16"), hour == "12")

## Train KNN model without time factor

# Code to forecast next hour load
knn <- function(data, k) {
  # get load data
  load <- data$load
  n <- length(load)
  # normalise load data
  load <- (load - min(load)) / (max(load) - min(load))
  # vector to hold distance between k nearest neighours
  dist <- rep(0, k)
  for(i in 1:k) {
    dist[i] <- sqrt((load[n] - load[n-k+i])^2) 
  }
  # vector to hold predictor weight of k nearest neighbours
  alpha <- rep(0, k)
  for(j in 1:k) {
    alpha[j] <- (dist[k] - dist[j]) / (dist[k] - dist[1])
  }
  # vector to hold forecast load
  forecast <- load
  for(f in 1:k) {
    forecast[f] <- alpha[f] * load[f+1]
  }
  forecast[n] <- (1/sum(alpha))*sum(forecast)
  return(gather(data.frame(n=seq(1, length(load), 1), load, forecast), condition, measurement, load:forecast))
}

dataTrain <- knn(dataSystemDay[1:(0.6*nrow(dataSystemDay)), ], ceiling(sqrt(nrow(dataSystemDay))))

## Evaluate the model

# Code to create test set from day data


## Communicate result

# Code to summaries load and forecast
ddply(dataTrain, .(as.factor(condition)), summarise,
      blackout = sum(abs(measurement - 0) < 1e-6),
      sum = (sum(measurement) * (max(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")])- min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]))) + min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]),
      mean = (mean(measurement) * (max(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")])- min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]))) + min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]),
      max  = (max(measurement) * (max(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")])- min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]))) + min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]),
      min  = (min(measurement) * (max(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")])- min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]))) + min(dataSystemDay[1:(0.6*nrow(dataSystemDay)), c("load")]),
      sd   = sd(measurement),
      se   = sd / sqrt(length(measurement))
)
# Code to visualise trend based on time factor
ggplot(dataTrain, aes(n, measurement, group=condition, colour=condition)) + geom_line()
# Code to visualise distribution on time factor
ggplot(dataTrain, aes(x=measurement, fill=condition)) + geom_histogram(binwidth=.5, alpha=.5, position="identity")


