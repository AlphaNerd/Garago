angular.module('garago.directives.contenteditable', [])

  .directive("contenteditable", function($timeout, $garagoAPI, $rootScope) {
    function toInnerText(value) {
      var tempEl = document.createElement('div'),
        text;
      tempEl.innerHTML = value;
      text = tempEl.textContent || '';
      return text.trim();
    }
    return {
      restrict: "AEC",
      require: "ngModel",
      scope: false,
      transclude: true,
      controller: function($scope){
        this.DATA = function () {
          return $scope.DATA;
        }
        $scope.edit = function(attrs,data){
          console.log([this.DATA])
          this.DATA.save({
            success: function(res){
              console.log(res)
            },
            error:function(e,r){
              console.log(e,r)
            }
          })
        }
      },
      link: function(scope, element, attrs, ngModel) {
        // console.log(attrs.locked || 'n/a')
        var editorOptions = {
          toolbar: {
              buttons: ['bold', 'italic', 'removeFormat'],
          }
        }
        angular.element(element).addClass('selectable-with-editor');
        // Global MediumEditor
        ngModel.editor = new MediumEditor(element, editorOptions);

        ////////////////////////////////////////////////////////
        ////////////// SAVING & SAVE DELAY
        ////////////////////////////////////////////////////////
        var maxCount = 10 //// number of keystrokes between saves
        var currCount = 0
        var timer = 2000 //// milliseconds till save if feqCount not met
        var saveDelay;

        // element.bind('click', function($event) {
        //   console.log('clicked: ',$event,attrs)
        // });

        element.on('input', function($event) {
          // console.log("Keystroke: ", $event)
          if (currCount < maxCount) {
            $timeout.cancel(saveDelay);
            saveDelay = $timeout(function() {
              scope.edit(attrs,$event.target.innerHTML.replace("\n",""))
            }, 1000)
            currCount += 1
          }
          if (currCount == maxCount) {
            currCount = 0
          }
        });

        function read() {
          ngModel.$setViewValue(element.html());
        }

        ngModel.$render = function() {
          ngModel.editor.setContent(ngModel.$viewValue || "");
          var placeholder = ngModel.editor.getExtensionByName('placeholder');
          if (placeholder) {
            placeholder.updatePlaceholder(element[0]);
          }
        };

        ngModel.$isEmpty = function(value) {
          if (/[<>]/.test(value)) {
            return toInnerText(value).length === 0;
          } else if (value) {
            return value.length === 0;
          } else {
            return true;
          }
        };

        ngModel.editor.subscribe('editableInput', function (event, editable) {
          ngModel.$setViewValue(editable.innerHTML.trim());
        });

        scope.$watch('bindOptions', function(bindOptions) {
          ngModel.editor.init(element, bindOptions);
        });

        scope.$on('$destroy', function() {
          ngModel.editor.destroy();
        });

        element.bind("blur keyup change", function() {
          scope.$apply(read);
        });
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      }
    };
  });
