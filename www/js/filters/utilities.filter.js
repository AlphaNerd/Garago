angular.module('garago.filters.utilities', [])

.filter('moment', function($window) {
    return function(date) {
    	var newDate = new moment(date)
      return newDate.fromNow()
    };
  })