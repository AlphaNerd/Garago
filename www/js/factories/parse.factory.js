angular.module('garago.factory.parse', [])

.factory('$parseAPI', ['$http', '$timeout', '$q', '$ionicLoading', '$rootScope', function($http, $timeout, $q, $ionicLoading, $rootScope) {
  Array.prototype.move = function(old_index, new_index) {
    if (new_index >= this.length) {
      var k = new_index - this.length;
      while ((k--) + 1) {
        this.push(undefined);
      }
    }
    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
    return this; // for testing purposes
  };

  var obj = {
    ////// used for testing remote server is working
    test: function() {
      var deferred = $q.defer()

      return deferred.promise
    }
  }
  return obj
}])
