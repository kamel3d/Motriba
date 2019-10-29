# Motriba
This is a web app developed on Codeigniter 2.1.0 and run on PHP  5.6.31 and MySql 5.6

## Purpose

It was first developed back in 2011, the purpose was making a platform to rate world leaders daily and track their popularity, it lets the users vote one time in 24 hours and restart at midnight GMT, it uses cookies to remember users vote and also IP addresses, it stores IP addresses until midnight then delete them from the database.
it compares IP address to a range of IPs on the database to define the user location, there are simple ways to do that now (2019).

## UI and UX

The home page has a dropdown list of selected countries, selecting a country take the user to the country's main page, the country's main page has the main person, whether he/she is president, prime minister, king etc... and in some countries there more than one person if they are a known politician or leader of major party or a person with significant political influence in that specific country.
The vote consists of two simple options like or dislike, then the app would define if the vote is coming from within the country or from abroad and also displays the combined votes, along with a chart that draws daily popularity using Javascript library [amcharts](http://www.amcharts.com).

## Back-end

The app has a very simple back end that consist of an option to activate the site or take it offline for maintenance also, a simple interface to add and edit politicians and give them different roles, for example, whether the person is the main leader of that country or not, the app takes care of generating small size images version from the original one the admin upload to the system.

## Database Structure

The structure can be found [here](https://github.com/kamel3d/Motriba/blob/master/db_motriba.sql).

-   The table admin has a range named Maxcount it is a counter for many an IP address is allowed to vote, ideally, this should always be 1 but it was put there for testing and to check how often user tries to abuse the system and try to vote more than once.
-   Stat and stat_temp tables are almost identical, the votes go into stats_temp and then at midnight they get copied to stats, it was made as an extra layer of protection and to prevent uncomplete results from showing up during the vote.
-   Table country_ip contains a range of IP for each country and equivalent integer range, along with country code and country name, as it was stated before there are better ways to implement this now (2019), this table would need a constant update to keep country detection accurate.

The rest if tables are self-explanatory

## Cron Jobs

This consist of:
-   A function that runs every hour ann copy content of stats_temp table to stats.
-   A function that runs every 24 hours and creates a new entry in the stats table.

Cron jobs functions can be found [here](https://github.com/kamel3d/Motriba/blob/master/application/controllers/cronjob.php)

## Screenshots
  
![](https://github.com/kamel3d/Motriba/blob/master/images/home_page.png)

![](https://github.com/kamel3d/Motriba/blob/master/images/country_page.png)
![](https://github.com/kamel3d/Motriba/blob/master/images/admin1.png)
![](https://github.com/kamel3d/Motriba/blob/master/images/admin2.png)

![](https://github.com/kamel3d/Motriba/blob/master/images/admin3.png)

