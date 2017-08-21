angular.module('garago.factory.utility', [])

.factory('$localstorage', ['$window', function($window) {
    return {
        set: function(key, value) {
            $window.localStorage[key] = value;
        },
        get: function(key, defaultValue) {
            return $window.localStorage[key] || defaultValue;
        },
        setObject: function(key, value) {
            $window.localStorage[key] = JSON.stringify(value);
        },
        getObject: function(key) {
            return JSON.parse($window.localStorage[key] || '{}');
        },
        clear: function() {
            return $window.localStorage.clear();
        }
    }
}])


.factory('$userData', ['$ionicPopup', '$rootScope', '$q', '$http', '$ionicLoading', function($ionicPopup, $rootScope, $q, $http, $ionicLoading) {
    var data = {
        getCurrentUser: function() {
            if (Parse) {
                return Parse.User.current()
            } else {
                return false
            }

        },
        getUserImage: function() {
            return Parse.User.current().attributes.imageFile._url
        },
        saveUserPrefs: function(data){
            $ionicLoading.show({
                template: 'Saving your sheet...'
            })
            console.info("Save my prefs: ",[data])
            var deferred = $q.defer();
            Parse.User.current().set("calendarConfig",data.calendar)
            Parse.User.current().set("appConfig",data.app)
            Parse.User.current().save({
                success: function(res) {
                    console.log("Successfully saved new prefs")
                    $ionicLoading.hide()
                    deferred.resolve(res)
                },
                error: function(e, r) {
                    console.log("Error saving event: ", e, r)
                    deferred.reject(e)
                }
            })
            return deferred.promise;
        }
    }
    return data
}])


.factory('$GPSdata', ['$ionicPopup', '$rootScope', '$q', '$http', '$cordovaGeolocation', function($ionicPopup, $rootScope, $q, $http, $cordovaGeolocation) {
    var data = {
        getGPSdata: function() {
            var deferred = $q.defer()

            if (!window.cordova) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var myPosition = {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    }
                    $http.get("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" + myPosition.latitude + "," + myPosition.longitude + "&destinations=Rustico%20Resort,PEI&key=AIzaSyBVMyNsq8JsDOTtILq6lfrOexngw3ZwJ7E")
                        .then(function(res) {
                            myPosition.distance = res.data.rows[0].elements[0].distance.text
                            myPosition.duration = res.data.rows[0].elements[0].duration.text
                            deferred.resolve(myPosition)
                        })
                });
            }
            if (window.cordova) {
                var posOptions = { timeout: 10000, enableHighAccuracy: false };
                $cordovaGeolocation
                    .getCurrentPosition(posOptions)
                    .then(function(position) {
                        var myPosition = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        }
                        $http.get("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" + myPosition.latitude + "," + myPosition.longitude + "&destinations=Rustico%20Resort,PEI&key=AIzaSyBVMyNsq8JsDOTtILq6lfrOexngw3ZwJ7E")
                            .then(function(res) {
                                myPosition.distance = res.data.rows[0].elements[0].distance.text
                                myPosition.duration = res.data.rows[0].elements[0].duration.text
                                deferred.resolve(myPosition)
                            })
                    }, function(err) {
                        // error
                        alert("Error retrieving GPS location info")
                    });
            }

            if (navigator.onLine) { //// check if browser is online
                console.info("You are connected to a network.")
                $rootScope.USER_ONLINE = true; //// if connected to a network, set online status to true
            } else {
                $ionicPopup.alert({ //// if no connection to netork available
                        title: "Internet Disconnected",
                        content: "The internet is disconnected on your device."
                    })
                    .then(function(result) {
                        if (!result) {
                            ionic.Platform.exitApp(); //// exit the app
                        }
                    });
                deferred.reject("Error getting coordinates...")
            }
            return deferred.promise
        },
        getWeather: function() {
            var deferred = $q.defer()
            $http.get("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22pei%2C%20canada%22)%20and%20u%3D'c'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys")
                .then(function(res) {
                    deferred.resolve(res)
                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    alert(response)
                })
            return deferred.promise
        }

    }
    return data
}])