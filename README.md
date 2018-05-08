# Data Collector for PHP.UG

This repository is probably for temporary. It basically collects some externally generated data for new php.ug website. This commands expected to be run periodically using cron jobs.

## Requirements
- PHP 7.2
- Github Token
- Twitter App Token, App Secret, User Access Token and User Access Token Secret

## Installation

```bash
git clone https://github.com/mkorkmaz/data-collector.git
cd data-collector
cp config/autoload/local.php.dist config/autoload/local.php
nano config/autoload/local.php # Add your token and other secret keys
composer install
```

## Services

### Github

#### Get contributors list

##### Suggested run frequency

Daily, Manually if immediate action required

##### Command

```bash
bin/console github:team-members <organizationName> <outputPath>
```
##### Example
```bash
bin/console github:team-members php-ug /home/phpug/public/data/github-members.json
```


### Twitter


#### Get latest tweets

##### Suggested run frequency

Once per 6 hours, Manually if immediate action required


##### Command

```bash
bin/console twitter:latest-tweets <organizationName> <outputPath>
```
##### Example

```bash
bin/console twitter:latest-tweets php_ug /home/phpug/public/data/lastest-tweets.json
```