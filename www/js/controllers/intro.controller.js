angular.module('garago.controllers.intro', [])

.controller('IntroCtrl', ['$scope', '$ionicSlideBoxDelegate', '$state', function($scope, $ionicSlideBoxDelegate, $state) {
    //// Slide Options
    // console.log("Intro Ctrl Loaded")
    $scope.slideNum = 0;
    $scope.buttonLabel = 'Next'
    $scope.slideHasChanged = function(slide) {
        // console.log(slide)
        if (slide == $ionicSlideBoxDelegate.slidesCount() - 1) {
            $scope.buttonLabel = 'Enter'
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
            $state.go("login")
        } else {
            $ionicSlideBoxDelegate.next();
            $scope.slideNum = $ionicSlideBoxDelegate.currentIndex()
            $scope.totalSlides = $ionicSlideBoxDelegate.slidesCount()
        }
    }

    $scope.prevSlide = function() {
        $ionicSlideBoxDelegate.previous();
    }

    $scope.skipSlide = function() {
        $state.go("login");
    }

}])
