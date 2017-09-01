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
    var Messages = Parse.Object.extend("Messages")
    var Organizations = Parse.Object.extend("Organizations")
    var Teams = Parse.Object.extend("Teams")
    var Projects = Parse.Object.extend("Projects")
    var Activities = Parse.Object.extend("Activities")

    var obj = {
      ////////////////////////////////////////////////
      ////// Get all projects the current user is a member or owner of
      ////////////////////////////////////////////////
      getAllUserProjects: function(){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Projects)
        query1.exists("total_budget")
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Projects)
        query2.exists("total_budget")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("total_budget")
        mainQuery.find({
          success: function(res) {
            console.log("Found user's projects: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get a specific Project by ID
      ////////////////////////////////////////////////
      getUsersProjectById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(Projects)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Project by ID: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get the current user's most recent project
      ////////////////////////////////////////////////
      getUsersLastProject: function() {
        var deferred = $q.defer()
        var query1 = new Parse.Query(Projects)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Projects)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("updatedAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest Project: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get all activities the current user is a member or owner of
      ////////////////////////////////////////////////
      getAllUserActivities: function(){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Activities)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Activities)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's activities: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get a specific Activity by ID
      ////////////////////////////////////////////////
      getUsersActivityById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(Activities)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Activity by ID: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get the current user's most recent Activity
      ////////////////////////////////////////////////
      getUsersLastActivity: function() {
        var deferred = $q.defer()
        var query1 = new Parse.Query(Activities)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Activities)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("updatedAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest activity: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get all organizations the current user is a member or owner of
      ////////////////////////////////////////////////
      getUserOrganizations: function(data){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Organizations)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Organizations)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's organizations: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get all teams the current user is a member or owner of
      ////////////////////////////////////////////////
      getUserTeams: function(data){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Teams)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Teams)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's teams: ", [res[0]])
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
      ////////////////////////////////////////////////
      ////// Get the current user's most recent action plan
      ////////////////////////////////////////////////
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
      ////////////////////////////////////////////////
      ////// Get all of the current user's action plans where they are either
      ////// the Owner or Member
      ////////////////////////////////////////////////
      getAllUserActionPlans: function() {
        var deferred = $q.defer()        
        var query1 = new Parse.Query(ActionPlans)
        query1.exists("title")
        query1.exists("rows")
        query1.exists("columns")
        query1.descending("createdAt")
        query1.contains("members", Parse.User.current().id)
        
        var query2 = new Parse.Query(ActionPlans)
        query2.exists("title")
        query2.exists("rows")
        query2.exists("columns")
        query2.descending("createdAt")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        // query1.ascending("weight")

        mainQuery.find({
          success: function(res) {
            console.log("Found All User Action Plans: ", [res])
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
      ////////////////////////////////////////////////
      ////// Get a specific Action Plan by ID
      ////////////////////////////////////////////////
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
      },
      ////////////////////////////////////////////////
      ////// Get all user's messages
      ////////////////////////////////////////////////
      getUserMessages: function(res){
        var deferred = $q.defer()
        var query1 = new Parse.Query(Messages)
        query1.equalTo("sentFrom", Parse.User.current())

        var query2 = new Parse.Query(Messages)
        query2.equalTo("sentTo", Parse.User.current())

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("createdAt")
        mainQuery.limit(10)
        mainQuery.include("sentTo")
        mainQuery.include("sentFrom")
        mainQuery.find({
          success: function(res) {
            console.log("Found User Messages: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
          }
        }).then(function(res) {
          if (res) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      }
    }
    return obj
  }])
