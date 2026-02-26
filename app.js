require("dotenv").config();   // ✅ Load environment variables

const express = require("express");
const path = require("path");
const connectDB = require("./src/config/db");

const app = express();

// ✅ Connect Database
connectDB();

// ✅ Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// ✅ View Engine
app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "src/views"));

// ✅ Routes
app.use("/manpower", require("./src/routes/manpower"));
app.use("/pre-operative", require("./src/routes/preOperative"));

// ✅ Default Route
app.get("/", (req, res) => {
  res.redirect("/manpower");
});

// ✅ Use PORT from .env
const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});