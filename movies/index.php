<?php 
session_start();
include('../header.php');
include_once("../db_connect.php");

if(isset($_SESSION['user_id']) =="") {
	header("Location: ../index.php");
}

?>

<head>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>  
</head>
<br />
<br />
<br />

    <div class="manage-page">  
        <div>
   <br />
            <h3 align="center">Manage Movies</h3><br />
   <div class="table-responsive" ng-app="liveApp" ng-controller="liveController" ng-init="fetchData()">
                <div class="alert alert-success alert-dismissible" ng-show="success" >
                    <a href="#" class="close" data-dismiss="alert" ng-click="closeMsg()" aria-label="close">&times;</a>
                    {{successMessage}}
                </div>
                <form name="testform" ng-submit="insertData()">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Movie Title</th>
                                <th>Release Year</th>
                                <th>MovieDB ID</th>
                                <th>IMDB ID</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td><input type="text" ng-model="addData.movie_title" class="form-control" placeholder="Enter Movie Title" ng-required="true" /></td>
                                <td><input type="text" ng-model="addData.releaseyear" class="form-control" placeholder="Enter Release Year" ng-required="true" /></td>
                                <td><input type="text" ng-model="addData.moviedb_id" class="form-control" placeholder="Enter MovieDB ID" ng-required="true" /></td>

                                <td><input type="text" ng-model="addData.imdb_id" class="form-control" placeholder="Enter IMDB ID" ng-required="true" /></td>


                                <td><button type="submit" class="btn btn-success btn-sm" ng-disabled="testform.$invalid">Add</button></td>
                            </tr>
                            <tr ng-repeat="data in namesData" ng-include="getTemplate(data)">
                            </tr>
                          
                        </tbody>
                       
                    </table>
                </form>
                <script type="text/ng-template" id="display">
                    <td>{{data.movie_title}}</td>
                    <td>{{data.releaseyear}}</td>
                    <td>{{data.moviedb_id}}</td>
                    <td>{{data.imdb_id}}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" ng-click="showEdit(data)">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="deleteData(data.movie_id)">Delete</button>
                    </td>
                </script>
                <script type="text/ng-template" id="edit">
                    <td><input type="text" ng-model="formData.movie_title" class="form-control"  /></td>
                    <td><input type="text" ng-model="formData.releaseyear" class="form-control"  /></td>
                    <td><input type="text" ng-model="formData.moviedb_id" class="form-control" /></td>
                    <td><input type="text" ng-model="formData.imdb_id" class="form-control" /></td>
                    <td>
                        <input type="hidden" ng-model="formData.data.movie_id" />
                        <button type="button" class="btn btn-info btn-sm" ng-click="editData()">Save</button>
                        <button type="button" class="btn btn-default btn-sm" ng-click="reset()">Cancel</button>
                    </td>
                </script>         
   </div>  
  </div>


<script>
var app = angular.module('liveApp', []);

app.controller('liveController', function($scope, $http){

    $scope.formData = {};
    $scope.addData = {};
    $scope.success = false;

    $scope.getTemplate = function(data){
        if (data.movie_id === $scope.formData.movie_id)
        {
            return 'edit';
        }
        else
        {
            return 'display';
        }
    };

    $scope.fetchData = function(){
        $http.get('select.php').success(function(data){
            $scope.namesData = data;
        });
    };

    $scope.insertData = function(){
        $http({
            method:"POST",
            url:"insert.php",
            data:$scope.addData,
        }).success(function(data){
            $scope.success = true;
            $scope.successMessage = data.message;
            $scope.fetchData();
            $scope.addData = {};
        });
    };

    $scope.showEdit = function(data) {
        $scope.formData = angular.copy(data);
    };

    $scope.editData = function(){
        $http({
            method:"POST",
            url:"edit.php",
            data:$scope.formData,
        }).success(function(data){
            $scope.success = true;
            $scope.successMessage = data.message;
            $scope.fetchData();
            $scope.formData = {};
        });
    };

    $scope.reset = function(){
        $scope.formData = {};
    };

    $scope.closeMsg = function(){
        $scope.success = false;
    };

    $scope.deleteData = function(movie_id){
        if(confirm("Are you sure you want to remove it?"))
        {
            $http({
                method:"POST",
                url:"delete.php",
                data:{'movie_id':movie_id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };

});

</script>