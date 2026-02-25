const mongoose = require("mongoose");

const manpowerSchema = new mongoose.Schema({
  designation: String,
  no_of_employees: Number,
  salary_per_employee: Number
});

module.exports = mongoose.model("Manpower", manpowerSchema);