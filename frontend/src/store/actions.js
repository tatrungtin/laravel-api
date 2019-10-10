export default {
    LOGIN({ commit } , { email , password , code , is_guest }){
        return new Promise(function(resolve, reject) {
            var url = '/api/users/login'
            axios.post(url, formdata )
            .then(function (res) {
                let { status , data } = res.data 
                if( status ){
                    let { token }  = data 
                    commit('login',{ token })
                    
                }
                resolve(res)
            })
            .catch(function (err) {
                reject(err)
            });
        });
    },
    LOGOUT({commit}){
        commit('logout')
    },
}