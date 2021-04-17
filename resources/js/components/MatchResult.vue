<template>
    <div>
        <h3>Match Result</h3>
        <h6>{{this.$store.getters.getWeek}}TH Week Match Result</h6>
        <div v-if="this.getWeek > 0">
            <div v-for="item in this.fixture" v-bind:key="item.id">
             <p>
                {{ item.home_team.name }}
                <span v-if="item.home_score == null"> - </span>
                <span v-if="item.home_score != null">{{ item.home_score }}</span>
                 |
                <span v-if="item.away_score == null"> - </span>
                <span v-if="item.away_score != null">{{ item.away_score }}</span>
                {{ item.away_team.name }}
            </p>         
        </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        computed: {
            fixture() {
                var list = this.$store.getters.getFixture
                var week = this.$store.getters.getWeek
                var result = list.filter(item => item.week == week)
                return result      
            },
            getWeek() {
                return this.$store.getters.getWeek
            }
        }
    }
</script>

<style>
</style>
