## Sensika Senior PHP Developer Challenge

### Introduction
Imagine you just joined Sensika 7 years ago and we are now starting to develop our media monitoring solution.
In essence our newly founded company is collecting media content from lots of media outlets.

We want to impress investors very early on and showcase our capabilities by building a prototype to PoC our product idea in front of them.

We have decided that we want to start with their favourite news websites:

* https://edition.cnn.com
* https://bbc.com

Furthermore, our content harvesting strategy would be fetching the HTML homepages with article headlines and converting them to RSS/Atom Feeds or JSON objects with the following properties:

* the absolute article URLs
* article headlines 

#### Bonus points:
If we have the time before our investor demo, we would really like to complete the following as well:

* more article metadata, like time published, article media
* full article text
* Non-blocking http communication


### Criteria
For full transparency, the test will be scored according to the following:

* Extendability to a real world scenario
* Can handle easily a lot of other news portals
* Ability to handle the largest possible number of articles, listed on the homepages
* Regular commits
* Best practices (https://phptherightway.com/) 
* Reusable code
* Decoupled code
* Formatted code