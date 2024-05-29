jQuery(document).ready(function( $ ) {
	$(function() {
    $('#animate-environmental-btn, #slide-environmental-btn').mouseenter(function() {
      $('#animate-block').addClass("hover-grow bg-color-environmental");
    }).mouseleave(function () {
      $('#animate-block').removeClass("hover-grow bg-color-environmental");
    });

    $('#animate-geotechnical-btn, #slide-geotechnical-btn').mouseenter(function() {
      $('#animate-block').addClass("hover-grow bg-color-geotechnical");
    }).mouseleave(function () {
      $('#animate-block').removeClass("hover-grow bg-color-geotechnical");
    });

    $('#animate-mundic-btn, #slide-mundic-btn').mouseenter(function() {
      $('#animate-block').addClass("hover-grow bg-color-mundic");
    }).mouseleave(function () {
      $('#animate-block').removeClass("hover-grow bg-color-mundic");
    });

    $('#animate-mining-btn, #slide-mining-btn').mouseenter(function() {
      $('#animate-block').addClass("hover-grow bg-color-mining");
    }).mouseleave(function () {
      $('#animate-block').removeClass("hover-grow bg-color-mining");
    });

    $('#animate-drone-btn, #slide-drone-btn').mouseenter(function() {
      $('#animate-block').addClass("hover-grow bg-color-drone");
    }).mouseleave(function () {
      $('#animate-block').removeClass("hover-grow bg-color-drone");
    });
	
  });
});
