
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap-sass');
window.axios = require('axios');

// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

// $(document).ready(function() {
//     $('[data-toggle="popover"]').popover();
// });

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

import Vue from 'vue'
import ProductsList from './components/products/List'
import CategoriesList from './components/categories/List'
import PrimeNumber from './components/primenumber/Table'

new Vue({
  el: '#app',
  components: { ProductsList, CategoriesList, PrimeNumber }
});