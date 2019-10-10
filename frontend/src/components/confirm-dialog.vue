<template>
    <div class="vue-confirm-dialog">
        <transition name="fade" mode="out-in">
            <div class="modal" v-if="modal_show" ref="modal">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ options.title }}</h5>
                            <button type="button" class="close" @click="close()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ options.content }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" v-if="options.btnCloseShow" :class="options.btnCloseClass" @click="close()">{{ options.btnClose}}</button>
                            <button type="button" v-if="options.btnSaveShow" :class="options.btnSaveClass" @click="onSave">
                                <template v-if="options.isLoading">
                                    <div class="icon-loading"></div>
                                </template>
                                <template v-else>
                                    {{options.btnSave}}
                                </template>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop" @click="close()"></div>
            </div>
        </transition>
    </div>
</template>
<script>

export default {
    data(){
        return {
            options : {
                title : '',
                content : '',
                btnClose : 'Close',
                btnCloseShow : true,
                btnCloseClass : 'btn btn-secondary',
                btnSave : 'Done',
                btnSaveShow : true,
                btnSaveClass : 'btn btn-primary',
                onSave : null,
                onClose : null,
                isLoading: false,
            },
            modal_show: false
        }
    },
    methods: {
        onSave(){
            this.options.isLoading = true
            if( typeof this.options.onSave == 'function'){
                this.options.onSave().finally(()=>{
                    this.options.isLoading = false
                    this.close()
                })
            }else{
                this.options.isLoading = false
                this.close()
            }
        },
        show( options ){
            this.options = Object.assign(this.options ,options )
            this.modal_show = true
        },
        close(){
            if( this.options.isLoading ) return ;
            if( typeof this.options.onClose == 'function'){
                this.options.onClose().finally(()=>{
                    this.reset()
                })
            }else{
                this.reset()
            }
            this.modal_show = false
        },
        reset(){
            this.options = {
                title : '',
                content : '',
                btnClose : 'Close',
                btnCloseShow : true,
                btnCloseClass : 'btn btn-secondary',
                btnSave : 'Done',
                btnSaveShow : true,
                btnSaveClass : 'btn btn-primary',
                onSave : null,
                onClose : null,
                isLoading: false,
            }
        },
    },
};
</script>
<style lang="scss" scoped>
    .vue-confirm-dialog{
        user-select: none;
        .modal{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 50px 0;
            &-dialog{
                max-width: 450px;
                width: 450px;
                z-index: 1041;
            }
            &-body{
                padding: 30px 15px;
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
