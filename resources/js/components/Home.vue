<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Premier League Table</div>

                    <div class="card-body" v-if="getWeek !== null">
                        <div class="row">
                            <div class="col-md-8">
                                <league-table />
                            </div>
                            <div class="col-md-4">
                                <match-result />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" v-show="this.getWeek >=4">
                                <predictions />
                            </div>
                        </div>
                        <div class="row justify-content-between">
                                <div v-show="this.getWeek < 6 ">
                                    <button @click="playAll" v-show="this.getWeek == 0">Play All</button>
                                    <button @click="nextWeek">Next Week</button>
                                </div>
                                <div v-show="this.getWeek >= 6 ">
                                    <button @click="resetSession">Reset</button>
                                </div>
                                
                                
                        </div>
                    </div>

                    <div v-else>
                        <div class="row justify-content-center">
                                <button @click="createFixture">Create Fixture</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LeagueTable from "./LeagueTable"
    import MatchResult from "./MatchResult"
    import Predictions from "./Predictions"
    export default {
        mounted() {
            console.log('Home Component mounted.')
        },
        components: {
            LeagueTable,
            MatchResult,
            Predictions
        },
        computed: {
            getWeek() {
                return this.$store.getters.getWeek
            }
        },
        methods: {
            createFixture() {
                 this.$store.dispatch('createFixture')
            },
            nextWeek() {
                this.$store.dispatch('nextWeek')
            },
            resetSession() {
                this.$store.dispatch('resetSession')
            },
            playAll() {
                this.$store.dispatch('playAll')
            }
        }
    }
</script>
