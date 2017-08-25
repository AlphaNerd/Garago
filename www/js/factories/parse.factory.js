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
    var ActionPlans = Parse.Object.extend("ActionPlans")
    var obj = {
      ////// used for testing remote server is working
      getUsersLastActionPlan: function() {
        var deferred = $q.defer()
        var query1 = new Parse.Query(ActionPlans)
        query1.exists("title")
        query1.exists("rows")
        query1.exists("columns")
        query1.descending("createdAt")
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(ActionPlans)
        query2.exists("title")
        query2.exists("rows")
        query2.exists("columns")
        query2.descending("createdAt")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("createdAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest Action Plan: ", [res[0]])
          },
          error: function(e, r) {
            console.log(e, r)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      getAllUserActionPlans: function() {
        var deferred = $q.defer()

        var query1 = new Parse.Query(ActionPlans)
        query1.exists("title")
        query1.exists("rows")
        query1.exists("columns")
        query1.descending("createdAt")
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(ActionPlans)
        query2.exists("title")
        query2.exists("rows")
        query2.exists("columns")
        query2.descending("createdAt")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);

        mainQuery.find({
          success: function(res) {
            console.log("Found latest Action Plan: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      getUsersActionPlanById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(ActionPlans)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Action Plan: ", [res[0]])
          },
          error: function(e, r) {
            console.log(e, r)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      }
    }
    return obj
  }])