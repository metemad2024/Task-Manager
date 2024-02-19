/*!
* Start Bootstrap - Simple Sidebar v6.0.6 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 
var result;
var token = '';
var rootUrl = 'http://localhost:8000';
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
/* common functions */
function show_dashboard(){
    $('#login-password').val('');

    $('#wrapper').css({'display': 'flex'});
    $('.content-box').hide();
    $('#dashboard-box').show();
    $('#login').hide();
    if (localStorage.getItem('isAdmin') !== null) {
        if(localStorage.getItem('isAdmin')==1){
            $('.admin-menu').show();
        } else {
            $('.admin-menu').hide();
        }
    }
}

function show_login(){
    $('#wrapper').css({'display': 'none'});
    $('#login').show();
}

function show_admin_menu(){
    $('#wrapper').css({'display': 'none'});
    $('#login').show();
}

function getToken(){
    if (localStorage.getItem('myToken') !== null) {
        return localStorage.getItem('myToken');  
    } else {
        return '';
    }    
}

function showError(errorArray, targetTag){
    err = '';
    errorArray.forEach(function(item){
        err += (item + '<br/>');
        
    });
    $('#'+targetTag).html('<div class="alert alert-danger" role="alert">'+err+'</div>');
}

function showSuccess(msg, targetTag){
    $('#'+targetTag).html('<div class="alert alert-success" role="alert">'+msg+'</div>');
}
/* common functions */

/* << Menu functions */

// Task
$("#show-dashboard").on("click", function(){
    //alert("The paragraph was clicked.");
    var code = $(this).data('code');
    $('.content-box').hide();
    $('#'+code).show();
}); 

$("#show-add-task").on("click", function(){
    //alert("The paragraph was clicked.");
    var code = $(this).data('code');
    $('.content-box').hide();
    $('#'+code).show();
}); 



$("#show-task-list").on("click", function(){
    //alert("The paragraph was clicked.");
    var code = $(this).data('code');
    $('.content-box').hide();
    $('#'+code).show();
    page = 1;
    $.ajax({

        url: rootUrl+'/api/tasklist?page='+page,
        headers: {"Authorization": 'Bearer '+getToken()},
        data: {},
        dataType: 'json',

        method: 'post',

    }).done(function(data) {

        if(data.status==1){
            //token = data.token; 
            result = data.data;
            index = 1;
            $('#task-table-body').html('');
            const prio =['Undefined','High', 'Middle', 'Low'];
            data.data.data.forEach(element => {           
                var trow = '<tr><th scope="row">'+index+'</th><td>'+element.title+'</td><td>'+prio[element.priority]+'</td><td>'+element.dead_date+'</td><td>'+element.description+'</td>';
                var btns = '<td><span class="btn btn-danger delete-task-row" id="del-btn-'+element.id+'" onClick="delete_task(\'del-btn-'+element.id+'\', '+element.id+')" data-code="'+element.id+'">delete</span></td></tr>';
                $('#task-table-body').append(trow+btns);
                index++;
            });
            
        } else {
            
        }

    });
}); 

// User
$("#show-add-user").on("click", function(){
    //alert("The paragraph was clicked.");
    var code = $(this).data('code');
    $('.content-box').hide();
    $('#'+code).show();
}); 

$("#show-user-list").on("click", function(){
    //alert("The paragraph was clicked.");
    var code = $(this).data('code');
    $('.content-box').hide();
    $('#'+code).show();
    page = 1;
    $.ajax({

        url: rootUrl+'/api/userlist?page='+page,
        headers: {"Authorization": 'Bearer '+getToken()},
        data: {},
        dataType: 'json',

        method: 'post',

    }).done(function(data) {

        if(data.status==1){
            result = data.data;
            uindex = 1;
            $('#user-table-body').html('');
            const isadmin =['No','Yes'];
            data.data.data.forEach(element => {           
                var trow = '<tr><th scope="row">'+uindex+'</th><td>'+element.name+'</td><td>'+element.email+'</td><td>'+isadmin[element.isAdmin]+'</td>';
                var btns = '<td><span class="btn btn-danger delete-user-row" id="del-usr-btn-'+element.id+'" onClick="delete_user(\'del-usr-btn-'+element.id+'\', '+element.id+')" data-code="'+element.id+'">delete</span></td></tr>';
                $('#user-table-body').append(trow+btns);
                uindex++;
            });
            
        } else {
            
        }

    });
});
/* Menu functions >> */

/* << Form functions */
function delete_task(tagid, code){
    //alert("The paragraph was clicked.");
    var that = this;
    //var code = $(this).data('code');
    c = confirm("Are you sure you want to delete this task?");
    if(c){
        $.ajax({

            url: rootUrl+'/api/deletetask',
            headers: {"Authorization": 'Bearer '+getToken()},
            data: {
                id: code
            },

            dataType: 'json',

            method: 'post',

        }).done(function(data) {

            if(data.status==1){
                
                $('#'+tagid).parent().parent().remove();
                
            }

        });
    }
}

$("#submit-new-task").on("click", function(){
    
    
    var title = $('#task-title').val();
    var description = $('#task-description').val();
    var priority = $('#task-priority option:selected').val();
    var tddate = $('#task-date').val();
    
    $.ajax({

        url: rootUrl+'/api/addtask',
        headers: {"Authorization": 'Bearer '+getToken()},
        data: {
            title: title,
            description: description,
            priority: priority,
            dead_date: tddate
        },

        dataType: 'json',

        method: 'post',

    }).done(function(data) {

        if(data.status==1){
            showSuccess(data.message, 'new-task-msg')
            $('#task-title').val('');
            $('#task-description').val('');
            $('#task-date').val('');
        } else {
            showError(data.message, 'new-task-msg');
        }

    });
}); 

$("#submit-new-user").on("click", function(){
    
    
    var name = $('#user-name').val();
    var email = $('#user-email').val();
    var isAdmin = $('#user-isAdmin option:selected').val();
    var password = $('#user-password').val();
    var password_rep = $('#user-password-rep').val();
    
    $.ajax({

        url: rootUrl+'/api/adduser',
        headers: {"Authorization": 'Bearer '+getToken()},
        data: {
            name: name,
            email: email,
            isAdmin: isAdmin,
            password: password,
            password_confirmation: password_rep
        },

        dataType: 'json',

        method: 'post',

    }).done(function(data) {

        if(data.status==1){
            //$('#new-user-msg').text(data.message);
            showSuccess(data.message, 'new-user-msg')
            $('#user-name').val('');
            $('#user-email').val('');
            $('#user-password').val('');
            $('#user-password-rep').val('');
        } else {
            //$('#new-user-msg').text(data.message);
            showError(data.message, 'new-user-msg');
        }

    });
}); 

function delete_user(tagid, code){
    //alert("The paragraph was clicked.");
    var that = this;
    //var code = $(this).data('code');
    c = confirm("Are you sure you want to delete this task?");
    if(c){
        $.ajax({

            url: rootUrl+'/api/deleteuser',
            headers: {"Authorization": 'Bearer '+getToken()},
            data: {
                id: code
            },

            dataType: 'json',

            method: 'post',

        }).done(function(data) {

            if(data.status==1){
                
                $('#'+tagid).parent().parent().remove();
                
            } else {
                alert(data.message);
            }

        });
    }
}
/* Form functions >> */

/* << Login / Logout */

$("#login-btn").on("click", function(){
    //alert("The paragraph was clicked.");
    
    var email = $('#login-email').val();
    var passwd = $('#login-password').val();
    $.ajax({

        url: rootUrl+'/api/login',

        data: {
            email: email,
            password: passwd
        },

        dataType: 'json',

        method: 'post',

    }).done(function(data) {

        if(data.status==1){
            token = data.token;
            localStorage.setItem("myToken", token);
            if(data.isAdmin==1){
                localStorage.setItem("isAdmin", 1);
            } else {
                localStorage.setItem("isAdmin", 0);
            }
            show_dashboard();
        } else {
            $('#login-error').text(data.message);
        }

    });
}); 

$("#logout-menu").on("click", function(){
    //alert("The paragraph was clicked.");
    localStorage.clear();
    show_login();
}); 

/* Login / Logout >> */


if(localStorage.getItem('myToken')){
    show_dashboard();
} else {
    show_login();
}