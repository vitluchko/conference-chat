import React from 'react';
import './Authorization.scss';
import Input from "../../components/input/Input";
import Button from "../../components/button/Button";
import {NavLink} from "react-router-dom";
import Login from "./Login";
const Register = () => {
    return (
        <div className="wrapper">
            <div className="container">
                <h2>Create account</h2>
                <p>Already have an account? <NavLink to='/login'>Sign in</NavLink></p>
                <div className={"cred"}>
                    <Input type={"text"} placeholder={"First name"}/>
                    <Input type={"text"} placeholder={"Last name"}/>
                </div>
                <Input type={"email"} placeholder={"E-mail"}/>
                <Input type={"password"} placeholder={"Password"}/>
                <Button text={"Register"}/>
            </div>

        </div>
    );
};

export default Register;