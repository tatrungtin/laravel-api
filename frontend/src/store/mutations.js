import cookie from 'js-cookie'
import { router } from '@/main.js'
export default {
    login(state, { token }) {
        state.token = token
        cookie.set(`${state.token_name}` , token , { expires: 30 })
    },
    logout(state){
        state.token = null 
        state.user_type  = null 
        cookie.remove(`${state.token_name}`)
        router.push({ name : 'Login' })
    },
    loading(state , payload ){
        state.is_loading = payload
    },
    setUser(state , payload ){
        let { type } = payload 
        if( type == 'guest'){
            payload['role'] = 'guest'
        }
        state.user = payload
    },
    setBreadcrumb(state, payload){
        state.breadcrumb = payload
    }
}



