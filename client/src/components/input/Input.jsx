import React from 'react';
import './Input.scss';
const Input = ({...props}) => {
    return (
        <input type={props.type} className="input" placeholder={props.placeholder} required=""/>
    );
};

export default Input;