<template>
    <div>
        <h2>Predictions</h2>
        <div v-for="(item, index) in this.getPredicts" v-bind:key="item.id">
                <p>{{item.name}}: {{predictions[index]}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                predictions: [40, 30, 20,10],
            };
        },
        computed: {
            getPredicts() {
                var teams = this.$store.getters.getTeams
                var week = this.$store.getters.getWeek
                teams.sort((a, b) => (a.points < b.points) ? 1 : -1)

                if (teams[0].points == teams[1].points) {
                    this.predictions = [35, 35, 20,10]
                }
                else{
                    this.predictions =  [40, 30, 20,10]
                }
                if (week == 5 && teams[teams.length-1].points == 0) {
                    this.predictions = [45, 35, 30, 0]
                }
                return teams

            }
        }
    }
</script>

<style>
</style>
