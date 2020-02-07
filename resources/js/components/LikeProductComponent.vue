<template>
    <div class=" d-flex justify-content-right align-items-center">
        <a v-if="flag"   @click="check"><i class="fa fa-heart" style="color: red;"></i></a>
        <a v-if="!flag"  @click="check"><i class="fa fa-heart-o" style="color: #8d8d8d;"></i></a>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "LikeProductComponent",
        props:['product'],
        data(){
            return{
                flag:'',
                count:0,
            }
        },
        mounted() {

            axios.get('/api/productlikeCheck/'+ this.product.id).then(res=> {
                console.log(res.data.product.likes.length)
                if (res.data.product.likes.length) {
                    this.flag = true;
                }
                else{
                    this.flag = false;
                }
            }).catch(err=>{
                console.log(err)
            })


        },
        methods:{
            check:function () {
                if(this.flag){
                    axios.get('/api/product-dislike/'+ this.product.id).then(res=>{
                        if (res.data.product.likes.length) {
                            this.flag = true;
                        }
                        else{
                            this.flag = false;
                        }
                    }).catch(err=>{
                        console.log(err)
                    })
                }else{
                    axios.get('/api/product-like/'+ this.product.id).then(res=>{
                        if (res.data.product.likes.length) {
                            this.flag = true;
                        }
                        else{
                            this.flag = false;
                        }
                    }).catch(err=>{
                        console.log(err)
                    })
                }
            },
        }
    }
</script>

<style scoped>

</style>

