<template>
    <div class="vue-modal-template">
        <transition name="fade" mode="out-in">
            <div class="modal" v-if="modal_show">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" @submit.stop.prevent="onSubmit" novalidate>
                        <div class="modal-header">
                            <h5 class="modal-title">Change password</h5>
                            <button type="button" class="close" @click.stop.prevent="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Current password</label>
                                    <input type="password" class="form-control" v-model="form.old_password">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.old_password.$invalid && formstate">
                                            <small v-if="!$v.form.old_password.required" class="form-text text-danger">Current password is required </small>
                                        </div>
                                    </transition>
                                </div>
                                <div class="form-group">
                                    <label>New password</label>
                                    <input type="password" class="form-control" v-model="form.new_password">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.new_password.$invalid && formstate">
                                            <small v-if="!$v.form.new_password.required" class="form-text text-danger">Password is required </small>
                                            <small v-if="!$v.form.new_password.minLength" class="form-text text-danger">Password must have at least 6 letters</small>
                                        </div>
                                    </transition>
                                </div>
                                <div class="form-group">
                                    <label>Repeat password</label>
                                    <input type="password" class="form-control" v-model="form.re_password">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.re_password.$invalid && formstate">
                                            <small v-if="!$v.form.re_password.sameAs" class="form-text text-danger">Passwords must be identical</small>
                                        </div>
                                    </transition>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click.stop.prevent="close">
                                Cancel
                            </button>
                            <button class="btn btn-primary min-width-100" type="submit">
                                Change
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-backdrop" @click="close()"></div>
            </div>
        </transition>
    </div>
</template>
<script>
import { mapActions } from 'vuex';
import { required , requiredIf , email , minLength , integer  , minValue , sameAs} from 'vuelidate/lib/validators'
import lodash from 'lodash'
export default {
    name : 'ModalUser',
    props:{
        value : {
            type : Boolean,
        },
    },
    data(){
        return {
            is_loading : false,
            selected : [],
            formstate : false,
            form :{
                old_password  : '',
                new_password : '',
                re_password   : ''
            }
        }
    },
    computed:{
        modal_show : {
            get(){
                return this.value
            },
            set(value){
                this.$emit('input', value)
            }
        }
    },
    methods:{
        ...mapActions({
            change : 'User/CHANGE_PASSWORD'
        }),
        close(){
            this.modal_show = false
        },
        onSubmit(){
            this.formstate = true 
            if( !this.$v.form.$invalid && !this.is_loading){
                this.is_loading = true
                this.change({
                    old_password : this.form.old_password,
                    new_password : this.form.new_password
                })
                .then(res=>{
                    let { status , data }  = res.data 
                    if( status ){
                        this.$toasted.success('Change password successfully !')
                        this.close()
                    }else{
                        let {  message = null} = data 
                        if( message ){
                            this.$toasted.error(message)
                        }else{
                            this.$toasted.error('Oops.. Something Went Wrong.. !')
                        }
                    }
                })
                .catch(err=>{
                    this.$toasted.error('Oops.. Something Went Wrong.. !')
                })
                .finally(()=>{
                    this.is_loading = false
                })
            }
        }
    },
    validations(){
        var vm = this
        return {
            form : {
                old_password: {
                    required
                },
                new_password: {
                    required, minLength : minLength(6)
                },
                re_password : {
                    sameAs: sameAs('new_password')
                }
            }
        }
    },
    watch :{ 
        'value' : function(){
            this.formstate = false
        }
    }
}
</script>
<style lang="scss" scoped>
    .vue-modal-template{
        user-select: none;
        .modal{
            display: block;
            overflow: hidden auto;
            padding: 50px 0;
            &-dialog{
                z-index: 1041;
                width: 500px;
                max-width: 500px;
                margin: 0 auto;
            }
            &-body{
                padding:  15px;
                
            }
            &-footer{
                button{
                    min-width: 100px;
                }
            }
            &-backdrop{
                opacity: 0.5;
            }
        }
    }
</style>
