const express = require("express");
const router = express.Router();
const Manpower = require("../models/Manpower");

// ======================
// GET ALL RECORDS
// URL: /manpower
// ======================
router.get("/", async (req, res) => {
  try {
    const rows = await Manpower.find().sort({ _id: 1 });
    res.render("manpower", { rows });
  } catch (error) {
    console.error(error);
    res.status(500).send("Server Error");
  }
});

// ======================
// ADD NEW RECORD
// URL: /manpower/add
// ======================
router.post("/add", async (req, res) => {
  try {
    const { designation, employees, salary } = req.body;

    await Manpower.create({
      designation,
      no_of_employees: employees,
      salary_per_employee: salary
    });

    res.redirect("/manpower");
  } catch (error) {
    console.error(error);
    res.status(500).send("Error Adding Record");
  }
});

// ======================
// DELETE RECORD
// URL: /manpower/delete/:id
// ======================
router.get("/delete/:id", async (req, res) => {
  try {
    await Manpower.findByIdAndDelete(req.params.id);
    res.redirect("/manpower");
  } catch (error) {
    console.error(error);
    res.status(500).send("Error Deleting Record");
  }
});

module.exports = router;