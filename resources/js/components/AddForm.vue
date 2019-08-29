<template>
    <div>
        <div>
            <form @submit.prevent="addDay" id="add-form" class="form-group">
                <div>
                    <div class="col-md-2 form-group mr-2">
                        <label for="vacation-day" class="control-label">Vacation day</label>
                        <input type="date" class="form-control form-control-sm" v-model="form.vacationDay" id="vacation-day" name="vacation-day">
                        <small class="error-control" v-if="errors.date">
                            {{errors.date[0]}}
                        </small>
                    </div>
                    <div class="col-md-3 form-group pt-1">
                        <button type="submit" id="submit-add" name="submit-add" class="btn btn-info btn-sm mt5 ml5" title="Add vacation day" > <i class="fas fa-save" ></i>&nbsp;&nbsp;Add 1 vacation day</button>
                        <!--<a @click="hideForm" class="btn btn-danger btn-sm mt5 te" style="color: white" name="cancel-add"  title="Cancel Add Data ">&times;</a>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddForm",
        data() {
            return {
                form: {
                    name: 'Max',
                    vacationDay: ''
                },
                errors: {},

            }
        },

        methods: {
            addDay() {
                axios.post('/add-day', this.form)
                    .then(res => {
                        //console.log(res);
                        this.form.vacationDay='';
                        this.$emit('added');
                    })
                    .catch(err => console.log(err));
            },
        }
    }
</script>

<style scoped>

</style>