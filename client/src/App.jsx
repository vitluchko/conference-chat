import './App.css';
import {Route, Routes} from "react-router-dom";
import Register from "./pages/authorization/Register";
import Login from "./pages/authorization/Login";

function App() {
  return (
    <div className="App">
        <Routes>
            <Route path="register" element={<Register/>}/>
        </Routes>
        <Routes>
            <Route path="login" element={<Login/>}/>

        </Routes>
    </div>
  );
}

export default App;
