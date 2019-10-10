import Vue from 'vue'
import Vuex from 'vuex'
import cookie from 'js-cookie'
import actions from './actions';
import getters from './getters';
import mutations from './mutations';
Vue.use(Vuex)
let token_name = process.env.VUE_APP_TOKEN_NAME ? process.env.VUE_APP_TOKEN_NAME : 'token'
let token = cookie.get(token_name)  
const state = {
    token_name: token_name ,
    token : token ,
    is_loading : false,
}
export default new Vuex.Store({
    state,
    actions,
    getters,
    mutations,
    modules: {
        
    }
});
