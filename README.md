# eBokRuller

A display-thingy for new books in the library.

Only works for norwegian libraries using Bibliofil.

## Requirements
* [Bibliofil](http://bibliofil.no/)
* [jQuery Mobile Events](https://github.com/benmajor/jQuery-Touch-Events)
* A public access display with a touch screen. Like an iPad in kiosk mode on a stand or something

## Setup

1. Upload to your server. I've put ours in `/utvikling/bokskjerm/`, but you can put it anywhere you'd like.
2. Change the following settings in `index.php`

 ```php
 $bibliotek = 'DITT_BIBLIOTEK'; // as it appears in https://_____.bib.no
 $ccl = 'ff=la';
 ```
 
 The CCL can be anything. The above is eBooks. I originally made this thing for eBooks, but if you want to use it for something else, just change the CCL.

 ### Some example CCLs

 ```php
 $ccl = 'ff=la og ag=mu'; // eBooks for teenagers
 $ccl = 'plass=dark romance'; // Dark romance (We have a section for Twilight-style books)
 $ccl = '641*/KL'; // Food-related books
 $ccl = 'ff=di'; // Audio books
 ```
 
3. Point your public display to the address you've put all this stuff in.

4. Have a nice day!

## Additional options

The display currently displays each book for 20 seconds (and increases this to 40 if the user has scrolled 
down to read the book description. These values can be edited in `index.php`

 ```javascript
let shortCounter = 20000,
    longCounter = 40000;
 ```