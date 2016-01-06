
var setUpOCSsearch = {
  init: function() {
	self = this;

	this.h1 = document.querySelector('h1');
	// Hide the h1 immediately
	this.h1.className = 'sr-only';

	this.search = document.querySelector('#search-field');
	this.title = document.body.className.indexOf('home') !== -1 ? 'Search' : this.h1.firstChild.nodeValue;
	this.lenTest = document.getElementById('length-test');
	this.searchBoxWidth = this.search.clientWidth - 40;
	this.searchOriginalFontSize = window.getComputedStyle(this.search, null).getPropertyValue('font-size');
	this.sizeChanged = false;


	// Move it to the searchbox
	this.search.setAttribute('placeholder', self.title);
	this.search.setAttribute('data-og-font-size', self.searchOriginalFontSize);

	// Stuff the hidden length checker
	this.lenTest.innerHTML = self.title;
	// And check the new length
	self.checkSearchBoxLength();

	// Do stuff
	this.search.addEventListener('input', self.handleSearchChange);
	this.search.addEventListener('propertychange', self.handleSearchChange);
	this.search.addEventListener('blur', self.handleSearchChange);
	this.search.addEventListener('focus', self.focusInput);

  },

  // When the user clicks out of the box, reset the placeholder if empty
  focusInput: function() {
	self.search.setAttribute('placeholder', "");
  },

  checkSearchBoxLength: function(evt) {
	var width = (self.lenTest.clientWidth + 1);// + "px";
	if (width > self.searchBoxWidth) {
	  // resize on change but set a min and max font-size
	  self.search.style.fontSize = Math.max(Math.min((self.searchBoxWidth/width)*33, parseFloat(33)), parseFloat(13))+"px";
	  self.sizeChanged = true;
	} else if(self.sizeChanged && width < self.searchBoxWidth) {
	  self.search.style.fontSize = self.searchOriginalFontSize;
	}
  },

  handleSearchChange: function(evt) {
	var text_length = self.search.value.length;
	// Update our measuring div
	self.lenTest.innerHTML = self.search.value;
	if (text_length === 0) {
	  self.search.setAttribute('placeholder', self.title);
	  self.lenTest.innerHTML = self.title;
	}
	self.checkSearchBoxLength();
  }
};

if (window.innerWidth > 767) {
  // also on window.resize?
	document.onreadystatechange = function () {
		if (document.readyState === "interactive") {
		  setUpOCSsearch.init();
		}
	};
}
