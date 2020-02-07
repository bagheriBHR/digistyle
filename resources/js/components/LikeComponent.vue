<template>
    <div class=" d-flex justify-content-right align-items-center">
        <a v-if="flag"   @click.prevent="check"><i class="fa fa-heart" style="color: red;"></i></a>
        <a v-if="!flag"  @click.prevent="check"><i class="fa fa-heart-o" style="color: black;"></i></a>
        <h5 class="m-0 mr-2">{{count}} نفر</h5>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "LikeComponent",
        props:['post'],
        data(){
            return{
                flag:'',
                count:0,
            }
        },
        mounted() {

            axios.get('api/likeCheck/'+ this.post.id).then(res=> {
                console.log(res.data.post.likes.length)
                if (res.data.post.likes.length) {
                    this.flag = true;
                }
                else{
                    this.flag = false;
                  }
                this.likeCount();
            }).catch(err=>{
                console.log(err)
                this.likeCount();
            })


        },
        methods:{
            check:function () {

               if(this.flag){
                   axios.get('api/post-dislike/'+ this.post.id).then(res=>{
                       if (res.data.post.likes.length) {
                           this.flag = true;
                       }
                       else{
                           this.flag = false;
                       }
                       this.likeCount();
                   }).catch(err=>{
                       console.log(err)
                       this.likeCount();
                   })
               }else{
                   axios.get('api/post-like/'+ this.post.id).then(res=>{
                       if (res.data.post.likes.length) {
                           this.flag = true;
                       }
                       else{
                           this.flag = false;
                       }
                       this.likeCount();
                   }).catch(err=>{
                       console.log(err)
                       this.likeCount();
                   })
               }
            },
            likeCount:function () {
                axios.get('api/post-like-count/'+ this.post.id).then(res=>{
                    this.count = res.data.count;
                    console.log(this.count)
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>
