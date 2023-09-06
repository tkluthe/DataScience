library(car)
library(lsr)
library(ggplot2)

data = read.csv("../data/results2023.csv", header = TRUE, stringsAsFactors = TRUE)

data$normalized_response <- (data$response / data$max)

#ANOVA - two-way, type II
model = aov(normalized_response ~ group * method_choice, data = data)
Anova(model, type=2)
etaSquared(model)

#Pairwise Comparison - Bonferroni
pairwise.t.test(data$normalized_response, data$group, paired = FALSE, p.adjust.method = "bonferroni")
pairwise.t.test(data$normalized_response, data$method_choice, paired = FALSE, p.adjust.method = "bonferroni")

#boxplot
ggplot(data, aes(method_choice,normalized_response)) + geom_boxplot(aes(fill=group)) + xlab('Method Names') + ylab('Preference Rating (Normalized)') + ggtitle('Method Name Preferences') + theme(plot.title = element_text(hjust = 0.5))


