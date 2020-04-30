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
            <h3 align="center">Manage Users</h3><br />
   <div class="table-responsive" ng-app="liveApp" ng-controller="liveController" ng-init="fetchData()">
                <div class="alert alert-success alert-dismissible" ng-show="success" >
                    <a href="#" class="close" data-dismiss="alert" ng-click="closeMsg()" aria-label="close">&times;</a>
                    {{successMessage}}
                </div>
                <form name="testform" ng-submit="insertData()">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>User Type</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td><input type="text" ng-model="addData.firstname" class="form-control" placeholder="Enter First Name" ng-required="true" /></td>
                                <td><input type="text" ng-model="addData.lastname" class="form-control" placeholder="Enter Last Name" ng-required="true" /></td>
                                <td><input type="password" ng-model="addData.password" class="form-control" placeholder="Enter Password" ng-required="true" /></td>

                                <td><input type="text" ng-model="addData.email" class="form-control" placeholder="Enter Email" ng-required="true" /></td>
                                <td><input type="text" ng-model="addData.userType" class="form-control" placeholder=Enter Account Type" ng-required="true" /></td>



                                <td><button type="submit" class="btn btn-success btn-sm" ng-disabled="testform.$invalid">Add</button></td>
                            </tr>
                            <tr ng-repeat="data in namesData" ng-include="getTemplate(data)">
                            </tr>
                          
                        </tbody>
                       
                    </table>
                </form>
                <script type="text/ng-template" id="display">
                    <td>{{data.firstname}}</td>
                    <td>{{data.lastname}}</td>
                    <td>{{data.password}}</td>
                    <td>{{data.email}}</td>
                    <td>{{data.userType}}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" ng-click="showEdit(data)">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="deleteData(data.user_id)">Delete</button>
                    </td>
                </script>
                <script type="text/ng-template" id="edit">
                    <td><input type="text" ng-model="formData.firstname" class="form-control"  /></td>
                    <td><input type="text" ng-model="formData.lastname" class="form-control"  /></td>
                    <td><input type="text" ng-model="formData.password" class="form-control" /></td>
                    <td><input type="text" ng-model="formData.email" class="form-control" /></td>
                    <td><input type="text" ng-model="formData.userType" class="form-control" /></td>
                    <td>
                        <input type="hidden" ng-model="formData.data.user_id" />
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
        if (data.user_id === $scope.formData.user_id)
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

    $scope.deleteData = function(user_id){
        if(confirm("Are you sure you want to remove it?"))
        {
            $http({
                method:"POST",
                url:"delete.php",
                data:{'user_id':user_id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };

});

</script>