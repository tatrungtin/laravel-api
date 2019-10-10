import Vue from 'vue'
import moment from  'moment'
Vue.filter('capitalize' , function(s){
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
})
Vue.filter('limit' , function( str , limit = 10){
    if(str.length > limit) {
        str = str.substring(0,limit);
        str += '...'
    }
    return str
})

Vue.filter('get_length' , function( str ){
    return str.split(',').filter(Boolean).length
})
Vue.filter('date_string' , function(value, format = 'DD-MM-YYYY'){
    return moment(value, "YYYY-MM-DD").format(format)
})
Vue.filter('file_name' , function(value){
    return value.split('/').pop()
})
Vue.filter('number_code' , function(value){
    var num = value + 65 
    return String.fromCharCode(value + 65)
})