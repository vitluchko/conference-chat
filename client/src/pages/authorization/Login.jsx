import React from 'react';
import './Authorization.scss';
import Input from "../../components/input/Input";
import Button from "../../components/button/Button";
import {NavLink} from "react-router-dom";
const Register = () => {
    return (
        <div className="wrapper">
            <div style={{height:"350px"}} className="container">
                <h2>Login account</h2>
                <p>Don`t have an account? <NavLink to={'/register'}>Sign up</NavLink></p>
                <Input type={"email"} placeholder={"E-mail"}/>
                <Input type={"password"} placeholder={"Password"}/>
                <Button text={"Register"}/>
            </div>

        </div>
    );
};

export default Register;