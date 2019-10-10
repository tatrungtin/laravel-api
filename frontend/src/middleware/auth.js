export default ({ next, router , store })=> {
	if ( !store.state.token ) {
		next({ name: 'Login' })
		return false
	}
	return true
}