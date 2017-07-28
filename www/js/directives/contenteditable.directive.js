angular.module('starter.directives.contenteditable', [])

.directive("contenteditable", function($timeout) {
  return {
    restrict: "A",
    require: "ngModel",
    link: function(scope, element, attrs, ngModel) {
      var maxCount = 10 //// number of keystrokes between saves
      var currCount = 0
      var timer = 2000 //// milliseconds till save if feqCount not met
      var saveDelay;
      element.on('input', function($event) {
          console.log("Keystroke: ",$event)
          if(currCount < maxCount){
            $timeout.cancel(saveDelay);
            saveDelay = $timeout(function(){
                console.log("Save Data: ",[$event.target.innerHTML],[element],[attrs],[ngModel])
            },1000)
            currCount += 1
          }
          if(currCount == maxCount){
            console.log("Save Data: ",[$event.target.innerHTML],[element],[attrs],[ngModel])
            currCount = 0
          }
      });

      function read() {
        ngModel.$setViewValue(element.html());
      }

      ngModel.$render = function() {
        element.html(ngModel.$viewValue || "");
      };

      element.bind("blur keyup change", function() {
        scope.$apply(read);
      });
    }
  };
});
