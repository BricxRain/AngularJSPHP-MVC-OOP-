<?php require_once('templates/header.php') ?>

    <div ng-cloak ng-app="homeApp" ng-controller="homeController" class="divController">

        <div id="alertMesaagePrompt" ng-show="alert_div" class="alert alert-dismissible fade show alert-{{ alert_type_message }}" role="alert">
            <strong>{{ alert_type }}</strong> : {{ alert_message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="table-responsive" ng-init="getAllInformation()">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <input type="hidden" ng-model="information.id">
                        <td>
                            <input type="text" ng-model="information.name" class="form-control infoName" id="infoName">
                        </td>
                        <td>
                            <input type="text" ng-model="information.email" class="form-control infoEmail" id="infoEmail">
                        </td>
                        <td>
                            <input type="text" ng-model="information.age" class="form-control infoAge" id="infoAge">
                        </td>
                        <td ng-show="button_add_td">
                            <button class="btn btn-success" ng-click="addInformation()">Add</button>
                        </td>
                        <td ng-show="button_edit_td">
                            <button class="btn btn-success" ng-click="updateInformation()">Update</button>
                            <button class="btn btn-warning" ng-click="cancelInformation()">Cancel</button>
                        </td>
                    </tr>
                    <tr ng-repeat="info in information_array">
                        <td> {{ info.name }} </td>
                        <td> {{ info.email }} </td>
                        <td> {{ info.age }} </td>
                        <td>
                            <button class="btn btn-info" ng-click="editInfo(info)">Edit</button>
                            <button class="btn btn-danger" ng-click="deleteInfo(info.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script type="text/javascript" src="./assets/scripts/home.js"></script>

<?php require_once('templates/footer.php') ?>