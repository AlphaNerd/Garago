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
        user.set("username", data.email);
        user.set("password", data.password);
        user.set("email", data.email);

        user.signUp(null, {
            success: function(user) {
                // console.log("Parse user registered: ",Parse.User.current())
                $rootScope.USER = Parse.User.current();
                var ruckus = {
                    user: Parse.User.current()
                }
                $localstorage.setObject("ruckus", ruckus);
                $scope.newUser = {}
                $state.go("app.home")
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
