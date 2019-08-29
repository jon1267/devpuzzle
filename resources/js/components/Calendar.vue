<template>
    <div>

        <div>
            <add-form
                v-show="showAdd"
                v-on:added="afterAddDay"
            />
        </div>

        <div>
            <span class="h4">Simple Calendar vacations</span>
            <a @click="afterAddDay" class="btn btn-success btn-sm ml-3" style="color: white" name="refresh-calendar"  title="Refresh calendar"><i class="fas fa-sync" ></i>  Refresh Calendar</a>
            <a @click="showForm" class="btn btn-danger btn-sm m-2" style="color: white" name="show-add"  title="Show/Hide Add Data "> <i class="fas fa-eye" ></i> Show/Hide Form </a>
        </div>

        <div>
            <table class="table table-bordered table-striped" >
                <thead>
                <tr>
                    <th v-for="header in headers">{{ header }}</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{ this.name }}</td>
                    <td>{{ this.vacationDays }} / {{ this.vacationDays - this.countDays}}</td>
                    <td v-for="(days, month, index) in vacations" > {{ days }} </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Calendar",

        data() {
            return {
                vacations: [],
                countDays: 0,
                vacationDays: 20,
                showAdd: true,
                name: 'Max',
                headers: [
                    'Name', 'Days / Remaining', 'Jan', 'Feb', 'Mar',
                    'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec',
                ],
            }
        },

        created() {
            this.refreshCalendar();
            this.getCountDays();
        },

        methods: {
            refreshCalendar() {
                axios.get('/calendar')
                    .then(res => {
                        //console.log(res.data);
                        this.vacations = res.data;
                    })
                    .catch(err => console.log(err))
            },
            getCountDays() {
                axios.get('/good-days')
                    .then(res => {
                        this.countDays = parseInt(res.data);
                    })
                    .catch(err => console.log(err))
            },
            afterAddDay() {
                this.refreshCalendar();
                this.getCountDays();
            },
            showForm() {
                this.showAdd = ! this.showAdd;
            },
        }
    }
</script>

<style scoped>

</style>