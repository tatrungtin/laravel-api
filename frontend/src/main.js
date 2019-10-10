import Vue from 'vue'
import App from './layouts/App.vue'
import { sync } from 'vuex-router-sync'
import store from './store'
import router from './router'
import './plugins'
import './components'
import './styles/style.scss'
import mixin from './mixins'

Vue.config.productionTip = false

sync(store, router, { moduleName: 'router' } )
Vue.mixin(mixin)


const app = new Vue({
	store,
	router,
	render: h => h(App)
}).$mount('#app')

export  { app , store , router  }
