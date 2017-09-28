angular.module('garago.controllers.register', [])

  .controller('RegisterUserCtrl', ['$scope', '$state', '$ionicSlideBoxDelegate', '$ionicPopup', '$rootScope', '$localstorage', '$q', '$timeout', function($scope, $state, $ionicSlideBoxDelegate, $ionicPopup, $rootScope, $localstorage, $q, $timeout) {
    // console.log("Register a new user...")

    $scope.newUser = {};
    $scope.slideNum = 0;
    $scope.buttonLabel = 'Next'

    $scope.register = function(data) {
      // console.log("Register the user now: ", [data])
      var user = new Parse.User();
      user.set("firstName", data.firstName);
      user.set("lastName", data.lastName);
      user.set("username", data.email.toLowerCase());
      user.set("password", data.password);
      user.set("email", data.email.toLowerCase());
      console.info("CHECK FOR BETA ACCESS")
      /// temp check for beta users
      Parse.Cloud.run('validateBetaUser', {
        email: data.email.toLowerCase()
      }).then(function(res) {
        if (res) {
          console.info(res)
          user.set("betaTester", true);
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
        } else {
          console.info("Sorry, not a valid beta user")
          var alertPopup = $ionicPopup.alert({
            title: 'Sorry :(',
            template: "You've either misspelled your password, or you are not currently on our early beta user lists."
          });

          alertPopup.then(function(res) {
            console.log('Thank you');
          });
        }
      });
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
