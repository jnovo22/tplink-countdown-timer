# TPlink-countdown-timer

The Tplink Countdown Timer is a series of API calls to the TPLINK API Endpoint that automatically starts a user-defined countdown timer to any of your TP Link devices.


# Why?

When we had our first child, I had heard of wifi-enabled coffee makers.  I made the argument that wouldn't it be nice to wake up in the morning, and roll over, and turn on the coffee. My wife thought it was a dumb idea but since I talked about it so much, she started to look them up, and found most got bad reviews.  She came across the TPLINK smart plug (HS105) so she got me one to try it out.

# The Problem

The TP Link Kasa app allows you to set schedules and turn on/off devices, and lets you start a timer after a device turns on.  Since coffee makers turn off after a certain amount of time (2-ish Hours), that became cumbersome to start every time we turned on the coffee, so I wrote these series of API calls.

# The Solution

I have the API calls set to run every 5 minutes. It looks to see if the smartplug is "on" and if a timer has been started.  If the smartplug is on, and the timer is off, start the timer.  If the smart plug is on, and the timer is activated, do nothing.  If the smart plug is off, do nothing.
  
# Requirements

  - A non-programmable coffee maker.  It can only be an on/off one
  - A TP-link smart plug
  - A cron job or scheduled task to initiate the code at a set interval
  - A unique UUID (https://www.uuidgenerator.net/)

# Optional
  - A database server to store things like your api token and other information.  These can be hardcoded if you want
  - SQL scripts are included


### Installation

*  Just download and install on a php server 




### Development

Want to contribute? Great!  Just pull request and hack away.


### Todos

 - Add AWS lambda support
