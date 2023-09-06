# Docker Procedures

These are the procedures for running the Experiment Replication website using docker. This file 
describes the steps necessary to get the system running from first principles. 


## Necessary Installs

The following software is needed to compile the whole stack:

1. Docker Desktop: https://www.docker.com/products/docker-desktop

## Clone Repositories

1. Clone the DataScience repository:
2. The .yml is set to use a localhost version of the nginx conf file, you can change this to the prod version found in the same directory (conf/nginx/nginx-prod.conf), 
		and then generate self-signed certificates and place them in the folder named "secret." One command for doing this is listed in Common Issues.
3. Copy the default environment file for the local server and change it if used in production (e.g., cp env-dev .env). This file contains default values for MYSQL setup.
4. Use the terminal and at the root of this directory (where docker-compose.yml lives), then type docker-compose up. You can also use -d  to run the server in daemon mode.
5. During first initialization, the .sql file in the sqlinit directory will be used to setup the database.

## Experiment setup

When running the experiment, the webroot is [baseurl]/nomenclature/ and lives in the /application directory of the repo. For example, when running locally, you would navigate to localhost/nomenclature/

1. Homepage: Asks the user for an email address before continuing
2. Informed Consent: Presents the informed consent form as a webpage with a download option (for the participant's records) and set of accept/decline buttons. 
		Accepting continues the participant to a demographic survey and declining sends the participant to a "You have declined." page.
3. Demographic Survey: Two pages which collect demographic information about the user (degree, years of experience, age, etc). 
		Note: we use the education year selection in demographic survey page 1 (Freshmen, Sophomore, Junior, Senior, etc) to randomize language select (R, Python, Matlab) interventions within that group.
4. Experiment Protocol: This page explain the experiment protocol and provides a sample ranked choice survey question.
5. Tasks: This experiment uses a ranked choice survey design. There are 46 total tasks, but you may choose to add to this list. 
		The tasks are setup using the TEST and METHOD tables. For each TEST, there is TEST.CONCEPT and TEST.PHRASE (e.g., "Z-Score", "A value's number of standard deviations from the mean"). 
		This TEST.TEST_ID is used as a key in METHOD to match several rows (one for each potential method to present to the user). METHOD contains a METHOD.NAME and METHOD.LANGUAGE (e.g., "scale", "R"). 
		In this example, a task for Z-Score would present the participant with the TEST.CONCEPT and a set of method choices:
			1) for their intervention's existing language, like "scale"
			2) two options from our experimental choices "StandardDeviationsFromMean" and "Standardize"
			3) the technical name with similar formatting to our experimental choices "ZScore"
			4) a randomized word
		To add additional tasks, you will need to insert into these two tables and be sure to use the proper key to connect them so they will be added to the randomized order tasks.
6. Feedback: Asks a few post experiment feedback questions


## Common Issues

### Unable to locate image?
Sometimes Docker was unable to find or load a specific image from docker hub. I'm not sure if this has anything to do with firewalls or dns issues, but I found removing the version tags to help.

For Example: Change `image: IMAGE:VERSION-TAG` to `image: IMAGE`

### Docker is no longer available in WSL 2
If you're on windows, and the script fails, it may not be able to connect to the background docker process. (Perhaps hanging or frozen in the background)

Try either rebooting or restarting the Docker Desktop app, hopefully that resolves the issue. 

Also, sometimes WSL 2 loses access to the windows file system, resulting in a broken terminal environment where almost nothing can be found suddenly. 
I could only resolve this by rebooting my machine. It's very frustrating and occurs randomly, not sure why it occurs though. 

### IDE Broken on the local webserver
The server requires your host machine ports to line up with the internal docker ports. Ideally in the future all networking would be handled within the docker image and containers. For now, make sure to have a nginx map ports `80:80` and `443:443`

### Docker build error: Unable to load metadata 
This issue seems to come and go for me and random machines, and am not totally sure how to prevent it yet. 
If you end up facing this as well, I suggest to try deleting Docker's Cached images.
`docker builder prune -a`

### Use Redis on the PHP side 

In the latest version of the Quorum server, [Redis](https://redis.io/) is used inside of the PHP module. If you are upgrading the server from a previous one, using docker-compose up -d will not include it, leading to errors. The PHP module needs a rebuild, which we can do with the following command:

    docker-compose build --no-cache php

### docker-compose hangs on Droplet

If docker compose is hanging on a droplet, it might indicate there is not enough entropy. We can check this by running:

    cat /proc/sys/kernel/random/entropy_avail

To fix this, we can install haveged. We can do this with this command:

    apt-get install haveged

### Install Backup database on local machine or make backup file

To get a copy of the database run the following:

    docker exec -i database mysqldump -u<username> -p<password> nomenclature > backup.sql

To get just the schema and not get data you can run this command: 

    docker exec -i database mysqldump -u<username> -p<password> --no-data nomenclature > schema.sql   

With a copy of the schema or database, run the following to install into your local machine:

    docker exec -i database mysql -u<username> -p<password> nomenclature < backup.sql

### How do I make self-signed certificates on my local machine for testing?

You can use the following command:

    openssl req -x509 -newkey rsa:4096 -keyout key.pem -out cert.pem -sha256 -nodes -days 365

This generates two files, key.pem and cert.pem, which are sufficiently for a self-signed certificate on a local machine. They go in the folder /secret.

## Access the database
While there are several options to connect to the database, one option is to use the terminal and from the root directory of this repo:

	docker exec -it database bash
	mysql -u [username] -p
	use nomenclature;
