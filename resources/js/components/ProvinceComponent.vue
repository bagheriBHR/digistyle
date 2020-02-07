<template>
    <div>
        <div class="form-group d-flex required">
            <label  class="col-sm-2 control-label">استان</label>
            <div class="col-sm-10">
                <select class="form-control" name="province_id"  @change="getAllCities()" v-model="province">
                    <option>استان را انتخاب کنید</option>
                    <option v-if="!address" v-for="province in provinces" :value="province.id">{{province.name}}</option>
                    <option v-if="address" v-for="province in provinces" :value="province.id" :selected="province.id == address.province_id">{{province.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group d-flex required" v-if="cities.length>0">
            <label class="col-sm-2 control-label">شهر</label>
            <div class="col-sm-10">
                <select class="form-control" name="city_id">
                    <option v-if="!address" v-for="city in cities" :value="city.id">{{city.name}}</option>
                    <option v-if="address" v-for="city in cities" :value="city.id" :selected="city.id == address.city_id">{{city.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ProvinceComponent",
        data(){
            return{
                cities : [],
                provinces:[],
                province:'',
            }
        },
        props : ['address'],
        mounted() {
            axios.get('/api/provinces').then(res=>{
                this.provinces = res.data.provinces;
                console.log(this.provinces)
            }).catch(err=>{
                console.log(err)
            })
            if(this.address){
                this.province = this.address.province_id
                this.getAllCities();
            }
        },
        methods : {
            getAllCities : function () {
                axios.get('/api/cities/' + this.province).then(res=>{
                    this.cities = res.data.cities;
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>
