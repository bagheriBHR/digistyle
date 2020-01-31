<template>
<div>
    <div class="form-group row d-flex align-items-center">
        <label  class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی :</label>
        <div class="col-sm-5">
            <select name="categories[]" class="custom-field form-control form-control-sm" multiple="true" v-model="selected_categories" @change="onchange($event,null)">
                   <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row d-flex align-items-center">
        <label  class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">برند :</label>
        <div class="col-sm-5">
            <select name="brand_id" class="custom-field form-control form-control-sm">
                <option >انتخاب کنید...</option>
                <option v-if="!product" v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                <option v-if="product" v-for="brand in brands" :value="brand.id" :selected="product.brand_id == brand.id">{{brand.name}}</option>
            </select>
        </div>
    </div>
    <div v-if="flag">
        <div class="form-group row d-flex align-items-center" v-for="(attribute,index) in attributes">
            <label  class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ویژگی {{attribute.name}} :</label>
            <div class="col-sm-5">
                <select class="custom-field form-control form-control-sm" @change="addAttribute($event,index)">
                    <option >انتخاب کنید...</option>
                    <option v-if="!product" v-for="value in attribute.attribute_values" :value="value.id">{{value.name}}</option>
                    <option v-if="product" v-for="value in attribute.attribute_values" :selected="product.attribute_values[index] && product.attribute_values[index]['id'] == value.id" :value="value.id">{{value.name}}</option>

                </select>
            </div>
        </div>
    </div>
    <input type="hidden" :value="computed_attributes" name="attributes[]">
</div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "AttributeComponent",
        data() {
            return {
                categories: [],
                selected_categories: [],
                flag: false,
                attributes: [],
                selected_attributes: [],
                computed_attributes: [],
            }
        },
        props:['brands','product'],
        mounted() {
            axios.get('/api/categories').then(res =>{
                this.getAllChildren(res.data.categories, 0)
                console.log(this.categories)
            }).catch(err=>{
                console.log (err)
            })
            if(this.product){
                for(var i=0; i<this.product.categories.length; i++){
                    this.selected_categories.push(this.product.categories[i].id);
                }
                for(var i=0; i<this.product.attribute_values.length; i++){
                    this.selected_attributes.push({
                        'index': i,
                        'value': this.product.attribute_values[i].id,
                    })
                    this.computed_attributes.push(this.product.attribute_values[i].id);
                }
                var load = 'ok';
                this.onchange(null,load)
            }
        },
        methods : {
            getAllChildren:function (currentValue,level) {
                for(var i=0 ; i < currentValue.length ; i++){
                    var current=currentValue[i];
                    this.categories.push({
                        id: current.id,
                        name: Array(level+1).join("-----") + " " + current.name
                    })
                    if(current.children_recursive && current.children_recursive.length > 0 ){
                        this.getAllChildren(current.children_recursive,level+1);
                    }
                }
            },
            onchange: function(event,load){
                console.log(this.selected_categories)
                this.flag=false;
                axios.post('/api/categories/attribute',this.selected_categories).then(res=>{
                    if(this.product && load==null){
                        this.computed_attributes = [];
                        this.selected_attributes =[];
                    }
                    this.attributes = res.data.attributes;
                    this.flag = true;
                }).catch(err=>{
                    console.log(err);
                    this.flag= false;
                })
            },
            addAttribute: function (event,index) {
                for(var i=0; i< this.selected_attributes.length; i++){
                    var current = this.selected_attributes[i];
                    if(current.index == index){
                        this.selected_attributes.splice(i,1);
                    }
                }
                this.selected_attributes.push({
                    'index' : index,
                    'value' : event.target.value,
                })
                this.computed_attributes = [];
                for(var i=0; i< this.selected_attributes.length; i++){
                    this.computed_attributes.push(this.selected_attributes[i].value);
                }
                console.log(this.computed_attributes)
            }
        },
    }
</script>

<style scoped>

</style>
