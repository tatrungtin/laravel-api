<template>
    <div class="vue-modal-user-info">
        <transition name="fade" mode="out-in">
            <div class="modal" v-if="modal_show">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">USer info</h5>
                            <button type="button" class="close" @click.stop.prevent="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="text" :disabled="true" v-model="user.full_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" :disabled="true" v-model="user.role" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" :disabled="true" v-model="user.email" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" @click.stop.prevent="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <div class="modal-backdrop" v-if="modal_show" @click="close()"></div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    name : 'ModalQuestion',
    props:{
        value : {
            type : Boolean,
        },
    },
    data(){
        return {
            is_error: null,
            is_loading : false,
        }
    },
    computed:{
        ...mapGetters({
            user : 'getUser'
        }),
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
            getQuestion : 'Question/GET'
        }),
        onShow(){

        },
        onSelect(item){
            this.onSave(item)
            this.close()
        },
        close(){
            this.reset()
            this.modal_show = false
        },
        load(){
            this.is_loading = true 
            this.getQuestion(this.id)
            .then((res)=>{
                let { status , data  } = res.data
                if( status ){
                    this.is_error = null
                    this.data = data 
                }else{
                    this.is_error = true
                }
            }).catch(err=>{
                this.is_error = true
            })
            .finally(()=>{
                this.is_loading = false
            })
        },
        reset(){
            this.options = {
                title : '',
                content : '',
                btnClose : 'Close',
                btnCloseClass : 'btn btn-secondary',
                btnSave : 'Done',
                btnSaveClass : 'btn btn-primary',
                onSave : null,
                onClose : null,
                isLoading: false,
            }
        },
    },
    watch :{
        'value' :function(value){
            if( value ){
                
                
            }
        }
    }
}
</script>
<style lang="scss" scoped>
    .vue-modal-user-info{
        user-select: none;
        .modal{
            display: block;
            overflow: hidden auto;
            padding: 50px 0;
            &-dialog{
                z-index: 1041;
                width: 800px;
                max-width: 800px;
                margin: 0 auto;
            }
            &-body{
                padding:  15px;
                .question-answer{
                    ul{
                        list-style-type: none;
                        padding: 0 0 0 15px;
                    }
                }
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
