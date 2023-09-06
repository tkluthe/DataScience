library(car)
library(lsr)
library(ggplot2)

data = read.csv("../data/results2023_survey.csv", header = TRUE, stringsAsFactors = TRUE)

r = subset(data, group=="R")
python = subset(data, group=="Python")
matlab = subset(data, group=="Matlab")

R_age_mean = mean(r$age)
R_programingExp_mean = mean(r$totalxp)
R_statsExp_mean = mean(r$jobxp)
R_pythonExp_mean = mean(r$lang4)
R_matlabExp_mean = mean(r$lang10)
R_rExp_mean = mean(r$lang20)

R_age_sd = sd(r$age)
R_programingExp_sd = sd(r$totalxp)
R_statsExp_sd = sd(r$jobxp)
R_pythonExp_sd = sd(r$lang4)
R_matlabExp_sd = sd(r$lang10)
R_rExp_sd = sd(r$lang20)


R_age_mean
R_age_sd

R_programingExp_mean
R_programingExp_sd

R_statsExp_mean
R_statsExp_sd

R_statsExp_mean
R_statsExp_sd

R_pythonExp_mean
R_pythonExp_sd

R_matlabExp_mean
R_matlabExp_sd

R_rExp_mean
R_rExp_sd



Python_age_mean = mean(python$age)
Python_programingExp_mean = mean(python$totalxp)
Python_statsExp_mean = mean(python$jobxp)
Python_pythonExp_mean = mean(python$lang4)
Python_matlabExp_mean = mean(python$lang10)
Python_rExp_mean = mean(python$lang20)

Python_age_sd = sd(python$age)
Python_programingExp_sd = sd(python$totalxp)
Python_statsExp_sd = sd(python$jobxp)
Python_pythonExp_sd = sd(python$lang4)
Python_matlabExp_sd = sd(python$lang10)
Python_rExp_sd = sd(python$lang20)


Python_age_mean
Python_age_sd

Python_programingExp_mean
Python_programingExp_sd

Python_statsExp_mean
Python_statsExp_sd

Python_statsExp_mean
Python_statsExp_sd

Python_pythonExp_mean
Python_pythonExp_sd

Python_matlabExp_mean
Python_matlabExp_sd

Python_rExp_mean
Python_rExp_sd


Matlab_age_mean = mean(matlab$age)
Matlab_programingExp_mean = mean(matlab$totalxp)
Matlab_statsExp_mean = mean(matlab$jobxp)
Matlab_pythonExp_mean = mean(matlab$lang4)
Matlab_matlabExp_mean = mean(matlab$lang10)
Matlab_rExp_mean = mean(matlab$lang20)

Matlab_age_sd = sd(matlab$age)
Matlab_programingExp_sd = sd(matlab$totalxp)
Matlab_statsExp_sd = sd(matlab$jobxp)
Matlab_pythonExp_sd = sd(matlab$lang4)
Matlab_matlabExp_sd = sd(matlab$lang10)
Matlab_rExp_sd = sd(matlab$lang20)


Matlab_age_mean
Matlab_age_sd

Matlab_programingExp_mean
Matlab_programingExp_sd

Matlab_statsExp_mean
Matlab_statsExp_sd

Matlab_statsExp_mean
Matlab_statsExp_sd

Matlab_pythonExp_mean
Matlab_pythonExp_sd

Matlab_matlabExp_mean
Matlab_matlabExp_sd

Matlab_rExp_mean
Matlab_rExp_sd

