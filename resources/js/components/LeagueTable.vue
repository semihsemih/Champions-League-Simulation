<template>
    <div>
        <table>
            <tr>
                <th>Teams</th>
                <th>PTS</th>
                <th>P</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>GD</th>
            </tr>
            <tr v-for="item in this.initFixture.teams" v-bind:key="item.id">
                <td>{{item.name}}</td>
                <td>{{item.points}}</td>
                <td>{{item.played_games}}</td>
                <td>{{item.wins}}</td>
                <td>{{item.draws}}</td>
                <td>{{item.loses}}</td>
                <td>{{item.gd}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        computed: {
            initFixture() {
                var list = this.$store.getters.getFixture
                var week = this.$store.getters.getWeek
                var teams = this.$store.getters.getTeams
                teams.sort((a, b) => (a.points < b.points) ? 1 : -1)
                return {list, week, teams}

            }
        }
    }
</script>

<style>
table, th, td {
  border: 1px solid black;
}
</style>
