angular.module('garago.controllers.login', [])
  ////////////////////////
  /// LOGIN CONTROLLER //////////////////////////////////////////////////////
  ////////////////////////
  .controller('LoginCtrl', ['$scope', '$state', '$ionicModal', '$ionicPopup', '$localstorage', '$rootScope', '$ionicLoading', function($scope, $state, $ionicModal, $ionicPopup, $localstorage, $rootScope, $ionicLoading) {
    // console.log("Login Ctrl Loaded")

    $scope.login = function(data) {
      // console.log("Log in user with: ",data)
      $ionicLoading.show({
        template: '<ion-spinner class="spinner-balanced"></ion-spinner>',
        animation: 'fade-in',
        delay: 500
      });
      Parse.User.logIn(data.email, data.password, {
        success: function(user) {
          // Do stuff after successful login.
          // console.warn("User logged in: ", user)

          var shadmeadows = {
            user: user,
            showIntro: false
          }

          $localstorage.setObject("shadmeadows", shadmeadows)
          $rootScope.CurrentUser = user;
          $ionicLoading.hide()
          $state.go("app.listplan")
        },
        error: function(user, error) {
          // The login failed. Check error to see why.
          $ionicLoading.hide()
          var alertPopup = $ionicPopup.alert({
            title: 'Error!',
            template: error.message
          }).then(function(res){
            $state.go("app.listplan")
          });
          // console.log("Error logging in: ", error, [data])
        }
      });

    }

    $scope.recoverPassword = function(email) {
      Parse.User.requestPasswordReset(email, {
        success: function() {
          // Password reset request was sent successfully
          var alertPopup = $ionicPopup.alert({
            title: 'Success!',
            template: "A password reset email has been sent."
          });
          $scope.closePassReset()
        },
        error: function(error) {
          // Show the error message somewhere
          var alertPopup = $ionicPopup.alert({
            title: 'Error!',
            template: error.message
          });
        }
      });
    }

    $scope.registerNewUser = function() {
      $state.go("register");
    }

    $ionicModal.fromTemplateUrl('templates/modals/password-recovery.html', {
      scope: $scope,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.modal1 = modal;
    });

    $scope.openPassReset = function() {
      $scope.modal1.show();
    }

    $scope.closePassReset = function() {
      $scope.modal1.hide();
    }

    $scope.closeLogin = function() {
      $state.go("intro")
    };

    // Cleanup the modal when we're done with it!
    $scope.$on('$destroy', function() {
      $scope.modal1.remove();
    });
    // Execute action on hide modal
    $scope.$on('modal.hidden', function() {
      // Execute action
    });
    // Execute action on remove modal
    $scope.$on('modal.removed', function() {
      // Execute action
    });

  }])