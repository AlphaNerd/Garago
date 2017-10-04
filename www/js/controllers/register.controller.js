angular.module('garago.controllers.register', [])

  .controller('RegisterUserCtrl', ['$scope', '$state', '$ionicSlideBoxDelegate', '$ionicPopup', '$rootScope', '$localstorage', '$q', '$timeout', function($scope, $state, $ionicSlideBoxDelegate, $ionicPopup, $rootScope, $localstorage, $q, $timeout) {
    // console.log("Register a new user...")

    $scope.newUser = {};
    $scope.slideNum = 0;
    $scope.buttonLabel = 'Next'

    $scope.register = function(data) {
      // console.log("Register the user now: ", [data])
      var Invites = Parse.Object.extend("Invites")
      var query = new Parse.Query(Invites)
      query.equalTo("email",data.email.toLowerCase())
      query.find({
        success: function(res){
          console.log(res)
          var canUpload = res[0].attributes.canUpload
          if(res.length > 0){
            var user = new Parse.User();
            user.set("firstName", data.firstName);
            user.set("lastName", data.lastName);
            user.set("username", data.email.toLowerCase());
            user.set("password", data.password);
            user.set("email", data.email.toLowerCase());
            user.signUp(null, {
              success: function(user) {
                // console.log("Parse user registered: ",Parse.User.current())
                $rootScope.USER = Parse.User.current();
                $scope.newUser = {}
                $state.go("app.library")
              },
              error: function(user, error) {
                // Show the error message somewhere and let the user try again.
                var alertPopup = $ionicPopup.alert({
                  title: 'Error!',
                  template: error.message
                });
                // $state.go("register")
              }
            });
          }else{
            console.log("you have not been invited")
          }
        },
        error: function(e,r){
          console.log(e,r)
        }
      })
    }

    $scope.searchOrgs = function(name) {
      var Orgs = Parse.Object.extend("Organizations")
      var query = new Parse.Query(Orgs)
      query.contains("name", name)
      query.find({
        success: function(res) {
          console.log(res)
        },
        error: function(e, r) {
          console.log(e, r)
        }
      }).then(function(res) {

      })
    }

    $scope.cancelReg = function() {
      $state.go("login")
    }

    $scope.slideHasChanged = function(slide) {
      // console.log(slide)
      if (slide == $ionicSlideBoxDelegate.slidesCount() - 1) {
        $scope.buttonLabel = 'Register'
      } else {
        $scope.buttonLabel = 'Next'
      }
      if (slide == $ionicSlideBoxDelegate.slidesCount()) {
        $state.go("login")
      }
      $scope.slideNum = $ionicSlideBoxDelegate.currentIndex()
      $scope.totalSlides = $ionicSlideBoxDelegate.slidesCount()
    }

    $scope.nextSlide = function() {
      if ($scope.slideNum == $ionicSlideBoxDelegate.slidesCount() - 1) {
        $scope.register($scope.newUser);
      } else {
        $ionicSlideBoxDelegate.next();
        $scope.slideNum = $ionicSlideBoxDelegate.currentIndex()
        $scope.totalSlides = $ionicSlideBoxDelegate.slidesCount()
      }
    }

    $scope.prevSlide = function() {
      $ionicSlideBoxDelegate.previous();
    }

  }])
