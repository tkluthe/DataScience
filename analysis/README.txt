This README contains some details on the contents of the analysis directory. Included here are anonymized raw data files, several Quorum projects used to run the statistical analysis and produce charts and R scripts to run the statistical analysis. To run the Quorum projects,  you can go to https://quorumlanguage.com/download.html to download Quorum Studio.

/data: raw anonymized data
	results2023.csv: task responses (118 participants).
		'group': the language assignment (Matlab, Python, R)
		'method_choice': the categorized method name (Experimental, Experimental2, Technical, InterventionMethod, Random)
		'response': the points allocated to one of the method choice options on a task
		'max': the maximum point pool for the task
	results2023_survey.csv: demographics and open feedback questions
	
/ItestNomenclature: Quorum project that runs the two-way ANOVA and pairwise comparisons using t-tests with a Bonferroni correction

/ItestNomenclatureCharts: Quorum project that produces the boxplot of method names (categorized) versus normalized user preference ratings (separated by language group assignment)

/ItestNomenclatureGenerator: Quorum project that produces boxplots for individual concepts (with phrases in subtitle). Shows method names versus nroamlized user preference ratings (separated by language group assignment). To navigate through each of the concepts, you can iterate through the list using the A and D keys while focused on the game window. This can be used to produce the 2 x 2 subfigures in the paper.

/R: Contains the R code used for analysis.
	results_analysis.R: R code that runs the two-way ANOVA, pairwise comparisons using t-tests with a Bonferroni correction and produces the boxplot of method names (categorized) versus normalized user preference ratings (separated by language assignment)
	survey_analysis.R: R code that does some analysis on various demographics providing the mean and standard deviations