<template>
    <div>
      PFFF
    </div>
  </template>

  <script>
  import customTable from "./components/customTable";

  export default {
    name: "App",
    components: {
      customTable
    },
    data() {
      return {
        fields: ["name", "email", "role", { key: "admin", label: "Is admin ?" }],
        items: [
          {
            id: 1,
            name: "John",
            email: "john@john.com",
            role: 1
          },
          {
            id: 2,
            name: "Mike",
            email: "mike@mike.com",
            role: 2
          }
        ]
      };
    }
  };
  </script>

  <style>
  #app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  </style>
